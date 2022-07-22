// Ajax đăng nhập
$("#login_form").validate({
  rules: {
    password: {
      required: true,
    },
    email: {
      required: true,
      email: true,
      remote: "?act=check_mail_login",
    },
  },
  messages: {
    password: "Bạn chưa nhập password",

    email: {
      required: "Bạn chưa nhập email",
      email: "Email chưa đúng định dạng",
      remote: "Email của bạn chưa đăng ký",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "?act=login",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          alert(response.message);
        } else {
          alert(response.message);
          window.location = "?act=index";
        }
      },
    });
    event.preventDefault();
  },
});
// Ajax đăng ký
$("#register_form").validate({
  rules: {
    name: "required",
    password: "required",
    repassword: {
      required: true,
      equalTo: "#password",
    },
    email: {
      required: true,
      email: true,
      remote: "?act=check_mail",
    },
  },
  messages: {
    name: "Bạn chưa nhập họ và tên",
    password: "Bạn chưa nhập password",
    repassword: {
      required: "Bạn chưa nhập lại password",
      equalTo: "Password nhập lại không đúng",
    },
    email: {
      required: "Bạn chưa nhập email",
      email: "Email chưa đúng định dạng",
      remote: "Email đã tồn tại",
    },
  },
  submitHandler: function (form) {
    $.ajax({
      type: "POST",
      url: "?act=register",
      data: $(form).serializeArray(),
      success: function (response) {
        response = JSON.parse(response);
        if (response.status == 0) {
          alert(response.message);
        } else {
          alert(response.message);
          location.reload();
        }
      },
    });
    event.preventDefault();
  },
});
