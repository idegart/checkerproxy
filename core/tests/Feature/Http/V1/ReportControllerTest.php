<?php

namespace Tests\Feature\Http\V1;

use App\Jobs\ProcessProxy;
use App\Jobs\ProcessReport;
use App\Models\Proxy;
use App\Models\Report;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    use WithFaker;

    public function test_it_can_not_store_new_report_with_no_proxies(): void
    {
        $this->postJson('/api/v1/reports')
            ->assertJsonValidationErrorFor('proxies');
    }

    /**
     * @dataProvider badProxiesProvider
     */
    public function test_it_can_not_store_new_report_with_bad_proxies(array $proxies, string $key = '0'): void
    {
        $this->postJson('/api/v1/reports', [
            'proxies' => $proxies,
        ])
            ->assertJsonValidationErrorFor("proxies.$key");
    }

    public function test_it_can_store_new_report(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/v1/reports', [
            'proxies' => $ips = [
                $this->faker->ipv4 . ':' . rand(1000, 9999),
                $this->faker->ipv4 . ':' . rand(1000, 9999),
            ],
        ])
            ->assertSuccessful()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', fn(AssertableJson $json) => $json
                    ->has('report')
                )
                ->etc()
            );

        $this->assertDatabaseHas(Report::class, [
            'uid' => $response->json('data.report'),
        ]);

        foreach ($ips as $ip) {
            $this->assertDatabaseHas(Proxy::class, [
                'ip_address' => $ip,
            ]);
        }

        Queue::assertPushed(ProcessProxy::class, count($ips));

        Queue::assertPushed(ProcessProxy::class, function (ProcessProxy $job, string $queue) use ($ips) {
            return in_array($job->proxy->ip_address, $ips);
        });
    }

    public static function badProxiesProvider(): array
    {
        return [
            [
                ['test'],
            ],
            [
                ['692.248.222.879:43780'],
            ],
            [
                ['192.168.1.1:27052', '692.83.47.579:43780'],
                '1',
            ],
        ];
    }
}
