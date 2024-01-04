// ========theme color change js start==========

let switches = document.getElementsByClassName('switch');
let style = localStorage.getItem('style');

if (style == null) {
  setTheme('light');
} else {
  setTheme(style);
}

for (let i of switches) {
  i.addEventListener('click', function () {
    let theme = this.dataset.theme;
    setTheme(theme);
  });
}

function setTheme(theme) {
  if (theme == 'light') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/light.css';
  } else if (theme == 'sky') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/sky.css';
  } else if (theme == 'purple') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/purple.css';
  } else if (theme == 'dark') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/dark.css';
  }else if (theme == 'yellow') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/yellow.css';
  }else if (theme == 'cyan') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/cyan.css';
  }else if (theme == 'brown') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/brown.css';
  }else if (theme == 'orange') {
    document.getElementById('switcher-id').href = SITE_URL+'/public/frontend/assets/css/themes/orange.css';
  }
  localStorage.setItem('style', theme);
}
// ========theme color change js start==========

