export function checkLocal (key) {
  let data = localStorage.getItem(key)
  console.log(data)
  if (data !== null) {
    let dataObj = JSON.parse(data)
    if (new Date().getTime() - dataObj.time > 0) {
      localStorage.clear()
      console.log('已过期')
      return false
    } else {
      console.log('登录了未过期')
      return dataObj
    }
  } else {
    console.log('没登录')
    return false
  }
}

export function setLocal (key, data, days) {
  localStorage.setItem(key, JSON.stringify({
    data: data,
    time: new Date().getTime() + days * 24 * 60 * 60 * 1000
  }))
}
