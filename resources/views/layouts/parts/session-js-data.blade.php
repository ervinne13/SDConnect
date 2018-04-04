
<script type="text/javascript">
    var app = {session: {}};

    app.baseUrl = '{{url("/")}}';
    app.csrf = '{{csrf_token()}}';

    let session = {};

    session.currentUser = JSON.parse('{!! Auth::user() !!}');
    session.roleCodes = [];

    session.currentUser.roles.forEach(role => {
        session.roleCodes.push(role.code);
    });

    for (var i in session.currentUser.roles) {
        session.roleCodes.push(session.currentUser.roles[i].code);
    }

    session.hasRole = function (roleCode) {
        return session.roleCodes.indexOf(roleCode) >= 0;
    };

    session.isAdmin = session.hasRole("ADMIN");

    app.session = session;
</script>
