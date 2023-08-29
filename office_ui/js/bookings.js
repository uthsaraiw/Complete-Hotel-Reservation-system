
function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue, td2, txtValue2;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
  
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        }
          } else {
            tr[i].style.display = "none";
          }
        }
      }

function openForm(reservation_id, room_type, check_in_date,hotelid, occupancy_limit) {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("1").textContent = "Reservation ID: " + reservation_id ;
  document.getElementById("2").textContent = "Type: " + room_type ;
  document.getElementById("3").textContent = "Checkin Date: " + check_in_date ;
  document.getElementById("4").textContent = "Occupancy: " + occupancy_limit ;
  document.getElementById("hotelid").value = hotelid;
  document.getElementById("reservationid").value = reservation_id;

}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}