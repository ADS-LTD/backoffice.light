function imprimer(el) {
   var printContents = document.getElementById(el).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();
   setTimeout(function(){window.close();}, 1);     
   document.body.innerHTML = originalContents;
   newWin.print();
   newWin.close(); 
   }
   $("#excel").on("click", function (e) {
      e.preventDefault();
  
      var data_type = 'data:application/vnd.ms-excel';
      var table_div = document.getElementById('table-wrapper');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');
  
      var a = document.createElement('a');
      a.href = data_type + ', ' + table_html;
      a.download = 'exported_table_' + Math.floor(Math.random() * 9999999 + 1000000) + '.xls';
      a.click();
  });