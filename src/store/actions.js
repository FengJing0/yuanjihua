import * as types from "./mutation-type";

export function checkLocal(context, key) {
  let data = localStorage.getItem(key)
  if (data !== null) {
    let dataObj = JSON.parse(data)
    if (new Date().getTime() - dataObj.time > 0) {
      localStorage.clear()
      return false
    } else {
      return dataObj.data
    }
  } else {
    return false
  }
}

export function checkSession(context, key) {
  let data = sessionStorage.getItem(key)
  if (data !== null) {
    return JSON.parse(data)
  } else {
    return false
  }
}

export function setLocal(context, key) {
  let date = new Date().getTime() + 7 * 24 * 60 * 60 * 1000
  localStorage.setItem(key, JSON.stringify({
    data: context.state.user,
    time: date
  }))
}

export function upDate(context, key) {
  if (localStorage.getItem(key) !== null) {
    let date = new Date().getTime() + 7 * 24 * 60 * 60 * 1000
    localStorage.setItem(key, JSON.stringify({
      data: context.state.user,
      time: date
    }))
  }
  sessionStorage.setItem(key, JSON.stringify(context.state.user))
}

export function getTimes(context, date) {
  let now = new Date();
  let oldTime = new Date(parseInt(date) * 1000);
  let UnixTime = new Date(Math.abs(now - oldTime)).getTime();
  if (UnixTime / (24 * 60 * 60 * 1000 * 365 * 100) > 1) {
    return Math.floor(UnixTime / (100 * 365 * 24 * 60 * 60 * 1000)) + '个世纪前';
  }
  if (UnixTime / (24 * 60 * 60 * 1000 * 365) > 1) {
    return Math.floor(UnixTime / (365 * 24 * 60 * 60 * 1000)) + '年前';
  }
  if (UnixTime / (24 * 60 * 60 * 1000 * 30) > 1) {
    return Math.floor(UnixTime / (30 * 24 * 60 * 60 * 1000)) + '个月前';
  }
  if (UnixTime / (24 * 60 * 60 * 1000) > 1) {
    let time = Math.floor(UnixTime / (24 * 60 * 60 * 1000)) + '天前';
    console.log(time)
    return time
  }
  if (UnixTime / (60 * 60 * 1000) > 1) {
    return Math.floor(UnixTime / (60 * 60 * 1000)) + '小时前';
  }
  return Math.floor(UnixTime / 1000 / 60) + '分钟前';
}
