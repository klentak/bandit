$(document).ready(function () {

    let user = document.getElementById('users');

    if (user) {
        user.addEventListener('click', e => {
            if (e.target.className === "btn btn-danger btn-delete") {
                let id = e.target.getAttribute('data-id');

                if (confirm("Czy jestes pewnien że chcesz usunąć użytkownika " + id)) {
                    fetch(`/administration/delete/${id}`, {
                        method: 'DELETE'
                    }).then(res => window.location.reload());

                }
            }
        });
        user.addEventListener('change', e => {
            if (e.target.className === "form-control select")
            {
                let id = e.target.getAttribute('data-id');
                let role = e.target.selectedIndex;

                if (confirm("Czy jestes pewien, że chcesz zmienić role użytkownika " + id)) {
                     fetch(`/administration/role/${id}/${role}`).then(res => window.location.reload());
                }

                console.log(role);


            }
        });

    }
});
