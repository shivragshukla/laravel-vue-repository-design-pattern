import Moment from 'moment'

export function uppercaseFirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

export function dateFormat(date) {
  return Moment(date).format('MMMM D, YYYY');
}

export function subString(string) {
    return string.split(/\s+/).slice(0,10).join(" ");
}