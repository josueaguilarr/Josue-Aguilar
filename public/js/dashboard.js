import fetchAction from "./fetchAction.js";

const updateForm = document.getElementById('update-register-form');
const bodyTable = document.getElementById('body-table-users');
const modal = new bootstrap.Modal(document.getElementById('exampleModal'));

document.addEventListener('DOMContentLoaded', async function () {
    getAllUsers();
});

updateForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    if (updateForm.checkValidity()) {
        const updateData = await fetchAction(e.target, 'POST', 'UserController.php', 'update')

        if (updateData.success) {
            alert(updateData.message)
            modal.hide()
            bodyTable.innerHTML = '';
            getAllUsers();
        } else {
            alert(updateData.message)
        }
    } else {
        showErrors(e)
    }
})

async function getAllUsers() {
    const usersData = await fetchAction(null, 'GET', 'UserController.php', 'index');

    fillTable(usersData);
}

function showErrors(e) {
    e.stopPropagation()
    updateForm.classList.add('was-validated')
}

function fillTable(data) {
    data.forEach(user => {
        let tr = document.createElement('tr')

        for (const key in user) {
            const cell = document.createElement('td')
            cell.textContent = user[key]
            tr.appendChild(cell)
        }

        const editCell = document.createElement('td');
        const editButton = document.createElement('button');
        editButton.textContent = 'Editar';
        editButton.classList.add('btn', 'btn-primary');
        editButton.setAttribute('data-bs-toggle', 'modal');
        editButton.setAttribute('data-bs-target', `#modal-${user.id}`);

        editButton.addEventListener('click', () => {
            document.getElementById('user-id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('phone').value = user.phone;
            document.getElementById('email').value = user.email;
            document.getElementById('rfc').value = user.rfc;
            document.getElementById('notes').value = user.notes;

            modal.show();
        });

        editCell.appendChild(editButton);
        tr.appendChild(editCell);

        bodyTable.appendChild(tr)
    });
}

document.getElementById('searchInput').addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#body-table-users tr');

    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        let found = false;

        for (let i = 0; i < cells.length; i++) {
            if (cells[i].innerText.toLowerCase().includes(filter)) {
                found = true;
                break;
            }
        }

        row.style.display = found ? '' : 'none';
    });
});

document.getElementById('btn-export-csv').addEventListener('click', () => {
    const rows = document.querySelectorAll('#body-table-users tr');
    const content = [];

    const headers = Array.from(document.querySelectorAll('thead th')).slice(0, -1).map(th => th.innerText);
    content.push(headers.join(','));

    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        const rowData = Array.from(cells).map((cell, index) => {
            if (index < cells.length - 1) {
                return cell.innerText;
            }
        }).filter(Boolean);

        content.push(rowData.join(','));
    });

    const blob = new Blob([content.join('\n')], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', 'tabla_usuarios');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
})