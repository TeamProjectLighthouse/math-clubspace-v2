function notification(title,body) {
  let permission = Notification.permission;
  
  if (permission === 'granted') {
    showNotification(title, body);
  }
  else if (permission = 'default') {
    requestAndShowPermission();
  }
  else{
    alert('Use normal alert');
  }
  
  function requestAndShowPermission() {
    Notification.requestPermission(function(permission) {
      if (permission === 'granted') {
        showNotification(title, body);
      }
    });
  }
  
  function showNotification(title,body) {
    let notification = new Notification(title, { body });
    console.log("success!")
  
    notification.onclick = () => {
      notification.close();
    }
  }
}