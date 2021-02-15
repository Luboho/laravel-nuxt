export default function({store, redirect}) {
    if(store.state.auth.loggedIn) {
        if(store.state.auth.user.is_admin == 'true') {
            return;
        } else {
            return redirect('/');
        }
    } else {
        return redirect('/');
    }
}
