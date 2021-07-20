import Errors from './Errors'
import Request from './Request'

class Form {
  /**
   * Create a new Form instance.
   *
   * @param {object} data
   */
  constructor(data) {
    this.originalData = data;

    for (let field in data) {
      this[field] = data[field];
    }

    this.errors = new Errors();
    this.busy = false;
  }


  /**
   * Fetch all relevant data for the form.
   */
  data() {
    let data = {};

    for (let property in this.originalData) {
      data[property] = this[property];
    }

    return data;
  }

  /**
   * Manualy add field in form
   * @param {type} object
   */
  addParam(params) {
    let items = params || {};
    for (let item in items) {
      this.originalData[item] = items[item];
      this[item] = items[item];
    }
  }

  /**
   * Reset the form fields.
   */
  reset() {
    for (let field in this.originalData) {
      this[field] = '';
    }

    this.errors.clear();
  }


  /**
   * Send a POST request to the given URL.
   * .
   * @param {string} url
   */
  post(url) {
    return this.submit('post', url);
  }


  /**
   * Send a PUT request to the given URL.
   * .
   * @param {string} url
   */
  put(url) {
    return this.submit('put', url);
  }


  /**
   * Send a PATCH request to the given URL.
   * .
   * @param {string} url
   */
  patch(url) {
    return this.submit('patch', url);
  }


  /**
   * Send a DELETE request to the given URL.
   * .
   * @param {string} url
   */
  delete(url) {
    return this.submit('delete', url);
  }


  /**
   * Submit the form.
   *
   * @param {string} requestType
   * @param {string} url
   */
  submit(requestType, url) {
    let request = new Request(this.data());
    return new Promise((resolve, reject) => {
      request.send(requestType, url)
        .then(response => {
          this.onSuccess(response);
          resolve(response);
        })
        .catch(error => {
          switch (error.status) {
            case 422:
              this.onFail(error.data);
              break;
            default:

              break;
          }
          reject(error);
        });
    });
  }


  /**
   * Handle a successful form submission.
   *
   * @param {object} data
   */
  onSuccess(data) {
    this.busy = false;
    this.reset();
  }


  /**
   * Handle a failed form submission.
   *
   * @param {object} errors
   */
  onFail(errors) {
    this.busy = false;
    this.errors.record(errors);
  }
}

export default Form;
