/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function askForData(){
    var dataString = "type=" + $("#graph_options").val();
    $.ajax({
        type: "POST",
        url: "process/commentsPerDay.php",
        data: dataString,
        dataType: "json",
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(data){
            if(data.result == 1){
                //$.plot($("#placeholder"), [ data.ordenados ]);
                $('#place_for_graphs').html(data.table);
            }else{
                $('#place_for_graphs').html(data.table);
        }
        }

    });
}