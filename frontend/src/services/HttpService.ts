import axios, { type AxiosInstance } from 'axios'

const HttpService: AxiosInstance = axios.create({
  baseURL: 'http://localhost:3000/',
  headers: {
    'Content-Type': 'application/json'
  }
})

export default HttpService
