import axios from 'axios';
// import Toastr from './Toastr';
// import router from '@/router';

class Request {
  /**
   * Create a new Form instance.
   *
   * @param {object} data
   */
  constructor(data = {}) {
    this.data = data;
    this.params = {};
  }

  setParams(params = {}) {
    this.params = params;
    return this;
  }

  /**
   * Send a GET request to the given URL.
   * .
   * @param {string} url
  */
  get(url) {
    return this.send('get', url);
  }

  /**
   * Send a POST request to the given URL.
   * .
   * @param {string} url
   */
  post(url) {
    return this.send('post', url);
  }


  /**
   * Send a PUT request to the given URL.
   * .
   * @param {string} url
   */
  put(url) {
    return this.send('put', url);
  }


  /**
   * Send a PATCH request to the given URL.
   * .
   * @param {string} url
   */
  patch(url) {
    return this.send('patch', url);
  }


  /**
   * Send a DELETE request to the given URL.
   * .
   * @param {string} url
   */
  delete(url) {
    return this.send('delete', url);
  }

  send(requestType, url) {
    // axios.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem('token')}`;

    return new Promise((resolve, reject) => {
      axios({
        url: url,
        method: requestType,
        data: this.data,
        params: this.params
      }).then((response) => {
        // const message = response.data.message || null;
        // if (message) {
        //   Toastr.s(message);
        // }
        resolve(response.data);
      })
        .catch((error) => {
          // if (error.response.status === 401) {
          //   const token = localStorage.getItem('token');
          //   if (token) {
          //     this.send('post', '/api/refresh')
          //       .then((responseRefresh) => {
          //         localStorage.setItem('token', responseRefresh.data.token);
          //         const { config } = error;
          //         const request = new Request(config.data);
          //         request.send(config.method, config.url)
          //           .then((responseOld) => {
          //             resolve(responseOld);
          //           });
          //       })
          //       .catch((errorRefresh) => {
          //         reject(errorRefresh.response);
          //         localStorage.removeItem('user');
          //         localStorage.removeItem('token');
          //         router.push({ name: 'login' });
          //       });
          //   } else {
          //     router.push({ name: 'login' });
          //     reject(error.response);
          //   }
          // } else {
          //   Toastr.e(error.response.data.message);
          reject(error.response);
          // }
        });
    });
  }
}

export default Request;
