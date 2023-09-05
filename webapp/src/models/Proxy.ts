export default class Proxy {
    public readonly ip_address: string;
    public readonly completed_at: string;
    public readonly protocol: string;
    public readonly country: string;
    public readonly speed: string;

    constructor(ip_address, completed_at, protocol, country, speed) {
        this.ip_address = ip_address;
        this.completed_at = completed_at;
        this.protocol = protocol;
        this.country = country;
        this.speed = speed;
    }
}