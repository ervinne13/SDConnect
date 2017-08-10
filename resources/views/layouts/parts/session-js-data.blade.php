
<script type="text/javascript">
    var app = {session: {}};

    app.baseUrl = '{{url("/")}}';
    app.csrf = '{{csrf_token()}}';

    app.session.currentUser = JSON.parse('{!! Auth::user() || "{}" !!}');
    app.session.roleCodes = [];

//    app.session.currentUser.roles.forEach(role => {
//        session.roleCodes.push(role.code);
//    });
//
//    for (var i in session.currentUser.roles) {
//        session.roleCodes.push(session.currentUser.roles[i].code);
//    }
//
//    app.session.hasRole = function (roleCode) {
//        return session.roleCodes.indexOf(roleCode) >= 0;
//    };
//
//    app.session.isAdmin = session.hasRole("ADMIN");
</script>
