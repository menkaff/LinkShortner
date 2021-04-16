import http from 'k6/http';
import { sleep } from 'k6';
export default function () {
  http.get('http://0.0.0.0:8084/database/emjc');
  sleep(1);
}