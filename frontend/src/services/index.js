import axios from 'axios'

const baseURL = 'http://localhost:80/api/'

const api = axios.create({
  baseURL,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

export default api
