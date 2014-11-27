$().ready(function () {

    $("#buscar-txtbox").autocomplete("/users/search",
        {
            parse: function(data){ 
                var parsed = [];
                for (var i=0; i < data.length; i++) {
                    parsed[i] = {
                        data: data[i],
                        value: data[i].name //the search item
                    };
                }
                return parsed;
            },
            formatItem: function (row, i, max) {
                var str = row.name + ' (Telp: '+ row.telp +')' + '<br />';
                str += row.address;
                return str;                     
            },
            formatResult: function (row) {
                return row.name;
            },
            minChars: 2,
            max: 0,
            width: 224,
            scrollHeight: 420,
            dataType: 'json'
        }
    );
});