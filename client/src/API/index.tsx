/* import axios from 'axios';
export async function fetchJson<Response = any>(url: string, init?: RequestInit): Promise<Response> {
    const response = await fetch(
      `http://localhost/php_blog/api/${url}`,
      {
        ...init ?? {}
      })
  
  
    return response.json()
  } */
import axios from "axios";
const API = axios.create({ baseURL: 'http://localhost/php_blog/api' });
// eslint-disable-next-line import/no-anonymous-default-export
export default {
  fetchPosts: function () {
    return API.get('/post/read.php');
},
};