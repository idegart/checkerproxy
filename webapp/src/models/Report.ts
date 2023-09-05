import Proxy from "./Proxy";

export default class Report {
    public readonly uid: string;
    public readonly completed_at: string;
    public proxies: Proxy[];

    constructor(uid: string, completed_at: string) {
        this.uid = uid;
        this.completed_at = completed_at;
    }
}