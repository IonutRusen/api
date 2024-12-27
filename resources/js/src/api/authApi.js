import axios from 'axios'

const authApi= axios.create({

    baseURL:`${import.meta.env.VITE_API_URL}/`,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    },
    withCredentials: true
})

/*Create a request interceptor for my instance and get accessToken on the fly
authApi.interceptors.request.use(config => {
    config.headers["Accept"] = "application/json";
    return config;
  });


  authApi.interceptors.request.use(config => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest'
    return config
  })
*/

export default authApi