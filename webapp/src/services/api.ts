import apiInstance from "../plugins/axios";
import Report from "../models/Report";
import Proxy from "../models/Proxy";

class Api {
    async reports() {
        let {data} = await apiInstance.get('/api/v1/reports')

        return data['data'].map(o => new Report(o['uid'], o['attributes']['completed_at']))
    }

    async report(uid) {
        let {data} = await apiInstance.get(`/api/v1/reports/${uid}`)

        let report =  new Report(data['data']['report']['uid'], data['data']['report']['attributes']['completed_at'])

        report.proxies = data['data']['report']['relations']['proxies'].map(o => new Proxy(
            o['attributes']['ip_address'],
            o['attributes']['completed_at'],
            o['attributes']['protocol'],
            o['attributes']['country'],
            o['attributes']['speed'],
        ))

        return report
    }
}

const api = new Api()

export default api