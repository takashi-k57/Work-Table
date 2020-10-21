/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { setSelected } from './setselected';
import { changeHoliday } from './changeholiday';

window.addEventListener('DOMContentLoaded', () => {

    const listener = {
        oldvalue: '',
        handleEvent: function handleClick(event) {
            changeHoliday(event, this.oldvalue);
        }
    };

    const tds = document.querySelectorAll('.description td');
    for (const td of tds) {
      const input = td.getElementsByTagName('input')[0];
      const select = td.querySelector('select');

      if (input) {
        // データベースに登録された状態を元に、セレクトボックスをチェック状態にする
         setSelected(input, select);
      }

      // focus状態から古い値を取り出す
      select.addEventListener('focus', (e) => {
        listener.oldvalue = e.target.value;
      });

      // 古い値を参照し、公休・有休・代休などを更新する
      select.addEventListener('change', listener, false);
    }
  });