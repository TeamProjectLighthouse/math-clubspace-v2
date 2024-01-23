function parseJwt (token) {
  var base64Url = token.split('.')[1];
  var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
      return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));

  return JSON.parse(jsonPayload);
}
function handleCredentialResponse(response) {
  const responsePayload = parseJwt(response.credential);

  // console.log("Full Name: " + responsePayload.name);
  // console.log("Email: " + responsePayload.email);
  emailDomain = responsePayload.email.split("@");
  if (emailDomain[1] == "stu.pkc.edu.hk" || emailDomain[1] == "pkc.edu.hk" || emailDomain[1] == "puikiu.edu.hk"){
    window.location = `../dashboard/dashboard.php?email=${responsePayload.email}`;
  }
  else {
    notification("Access denied.", "Please sign in with 'stu.pkc.edu.hk' in order to access Math Clubspace.");
  }
}