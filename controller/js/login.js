
  document.getElementById("loginName").addEventListener("focus", function loginName() {
    errLName.innerHTML = "";
  });
  document.getElementById("loginPass").addEventListener("focus", loginPass);
  document.getElementById("reginName").addEventListener("focus", reginName);
  document.getElementById("date").addEventListener("focus", date);
  document.getElementById("reginEmail").addEventListener("focus", reginEmail);
  document.getElementById("reginPass").addEventListener("focus", reginPass);
  document.getElementById("reginDT").addEventListener("focus", reginDT);
  document.getElementById("reginPassWord").addEventListener("focus", reginPassWord);
  document.getElementById("diachi").addEventListener("focus", diachi);

  function loginName() {
    errLName.innerHTML = "";
  }

  function loginPass() {
    errLPass.innerHTML = "";
  }

  function reginName() {
    errRName.innerHTML = "";
  }

  function date() {
    errDate.innerHTML = "";
  }

  function reginEmail() {
    errREmail.innerHTML = "";
  }

  function reginDT() {
    errReginDT.innerHTML = "";
  }

  function reginPass() {
    errRPass.innerHTML = "";
  }

  function reginPassWord() {
    errRPassWord.innerHTML = "";
  }

  function diachi() {
    errRDiachi.innerHTML = "";
  }
