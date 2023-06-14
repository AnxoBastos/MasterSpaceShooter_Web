const tbody = document.getElementById('leaderboard-tbody');

function reloadTable(){
    fetch('http://proxecto.localhost:80/top')
        .then(response => response.json())
        .then(response => insertData(response))
        .catch(err => console.log(err));
}

setInterval(reloadTable, 20000);

function insertData(response){
    let counter = 1;
    tbody.innerHTML = '';
    response['scores'].forEach(element => {
        let date  = new Date(element['date'] * 1000);
        let dateString = ('0' + date.getDate()).slice(-2) + '-' + ('0' + (date.getMonth()+1)).slice(-2) + '-' + date.getFullYear().toString().slice(-2);
        let html = `<tr>
                        <td>${counter}</td>
                        <td>${element['username']}</td>
                        <td>${element['score']}</td>
                        <td>${dateString}</td>
                    <tr>`;
        tbody.insertAdjacentHTML('beforeend', html);
        counter++;
    });
}

