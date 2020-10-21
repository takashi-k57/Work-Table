/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.addEventListener('DOMContentLoaded', () => {
    const tds = document.querySelectorAll('.description td');
    for (const td of tds) {
      const input = td.getElementsByTagName('input');
      const select = td.querySelectorAll('select')[0];
      
      select.addEventListener('change', (e) => {
        console.log('changed');
        const tr = e.target.parentNode.parentNode;
        console.log(tr.querySelector('.works'));
      });
      const options = td.querySelectorAll('select option');
      if (input.length) {
        const value = input[0].value;
        for (const option of options) {
          if (option.value == value) {
            option.setAttribute('selected', true);
          }
        }
      }
    }
  });