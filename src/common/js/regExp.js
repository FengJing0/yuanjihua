// export function enterPhoneNum(letter){
//     let reg = new RegExp(/[\d]/);
//     return reg.test(letter)?letter:''
// }

export function checkPhone (phone) {
  let reg = new RegExp(/^1[34578]\d{9}$/)
  return reg.test(phone)
}

export function checkPwd (pwd, repwd) {
  let reg = new RegExp(/^[0-9a-zA-Z]{6,16}$/)
  return reg.test(pwd) && pwd === repwd
}

export function checkIdent (ident) {
  let reg = new RegExp(/[a-zA-Z0-9]{6}/)
  return reg.test(ident)
}
