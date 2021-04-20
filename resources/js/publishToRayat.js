window.publishStudentHours = function (national_id, event) {
    let row = event.currentTarget.parentNode.parentNode;
    axios.post(window.publishToRayat, {
        national_id: national_id,
        state: event.target.checked,
        hours: document.getElementById('hours').value,
    })
        .then((response) => {
            console.log(response);
            row.remove();
            Swal.fire({
                position: "center",
                html: "<h4>"+response.data.message+"</h4>",
                icon: "success",
                showConfirmButton: false,
                timer: 1000,
            });
        })
        .catch((error) => {
            Swal.fire({
                position: "center",
                html: "<h4>" + error.response + "</h4>",
                icon: "error",
                showConfirmButton: true,
            });
        });
}


window.publishToRayatCommunity = function(national_id,order_id,event){
    let row = event.currentTarget.parentNode.parentNode;
    let requested_hours = document.getElementById('requested_hours').value;

let form = {
    national_id:national_id,
    requested_hours:requested_hours,
    order_id:order_id
}

axios.post(window.publishToRayat, form)
    .then((response) => {
        row.remove();
        Swal.fire({
            position: "center",
            html: "<h4>"+response.data.message+"</h4>",
            icon: "success",
            showConfirmButton: false,
            timer: 1000,
        });
    })
    .catch((error) => {
        Swal.fire({
            position: "center",
            html: "<h4>" + error.response.data.message + "</h4>",
            icon: "error",
            showConfirmButton: true,
        });
    });
}