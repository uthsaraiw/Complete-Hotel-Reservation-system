
function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue, td2, txtValue2, txtValue3, txtValue4, txtValue5, txtValue6,td3;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      td2 = tr[i].getElementsByTagName("td")[1];
      td3 = tr[i].getElementsByTagName("td")[2];
      td4 = tr[i].getElementsByTagName("td")[3];
      td5 = tr[i].getElementsByTagName("td")[4];
      td6 = tr[i].getElementsByTagName("td")[5];

      if (td) {
        txtValue = td.textContent || td.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        txtValue5 = td5.textContent || td5.innerText;
        txtValue6 = td6.textContent || td6.innerText;
  
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        }else {
          if (txtValue2.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            if (txtValue3.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              if (txtValue4.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                if (txtValue5.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  if (txtValue6.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";}}}}
          }
        }
      }
    }
  }