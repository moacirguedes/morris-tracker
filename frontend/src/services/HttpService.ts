import axios, { type AxiosInstance } from 'axios'

const HttpService: AxiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  validateStatus: () => true
})

export default HttpService
