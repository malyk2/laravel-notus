import BaseToastr from 'toastr2'
import 'toastr2/dist/toastr.min.css'

class Toastr {
  static s(message = ''){
    let base = new BaseToastr()
    base.success(message)
  }
  static e(message = ''){
    let base = new BaseToastr()
    base.error(message)
  }
  static w(message = ''){
    let base = new BaseToastr()
    base.warning(message)
  }
  static i(message = ''){
    let base = new BaseToastr()
    base.info(message)
  }
}

export default Toastr;