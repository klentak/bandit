class send_ajax{

    send_ajax(url, data)
    {
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {data},
            success: function (response) {
                return response
            }
        });
    }
}
export { send_ajax };