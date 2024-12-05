document.addEventListener("DOMContentLoaded", () => {
    // Verificar si está autenticado
    fetch('crud.php?action=checkAuth')
        .then(res => res.json())
        .then(data => {
            if (data.auth) {
                document.getElementById('auth').style.display = 'none';
                document.getElementById('crud').style.display = 'block';
                loadComputers();
            }
        });
});

function loadComputers() {
    fetch('crud.php?action=read')
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('computerList');
            list.innerHTML = '';
            data.forEach(computer => {
                const div = document.createElement('div');
                div.innerHTML = `
                    <strong>${computer.cpu}</strong> - ${computer.ram} - ${computer.gpu} - ${computer.storage}
                    <button onclick="deleteComputer(${computer.id})">Eliminar</button>
                `;
                list.appendChild(div);
            });
        });
}

function deleteComputer(id) {
    fetch(`crud.php?action=delete&id=${id}`)
        .then(() => loadComputers());
}
