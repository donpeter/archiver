/*function canDelete( obj) {
  return authUser()
   .done(function (user) {
      console.log('Auth User: ', user);
      if (user.id === obj.user_id || user.role ==='admin'|| user.role ==='staff') {
        return true;
      }else {
        return false;
      }
   })
   .fail(function (ert) {
      return false;
     console.log('err')
   });

   return false;
}*/

/*Fetch Current Auth User*/
var user;
authUser()
  .done(function (u) {
    user = u.user;
  });

function canDelete( obj, roles = ['admin']) {
  roles.push('admin');//Add admin to the array if or if not exist

  if (user.id === obj.user_id || roles.indexOf(user.role) !== -1 ) {
    return true;
  }else {
    return false;
  }
}

function authUser() {
  return $.getJSON('/user/auth')
    .done(function (res) {
      return res.user;
    })
    .fail(function (err) {
      return err.error;
    });
}