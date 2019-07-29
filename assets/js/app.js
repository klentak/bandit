$(document).ready(function () {


    let game = {

        number1: function() {
            return Math.floor(Math.random() * 10);
        },

        number2: function() {
            return Math.floor(Math.random() * 10);
        },

        number3: function() {
            return Math.floor(Math.random() * 10);
        },


        raffle: function () {


            let number1 = document.getElementsByClassName("number")[0].innerHTML=this.number1();
            let number2 = document.getElementsByClassName("number")[1].innerHTML=this.number2();
            let number3 = document.getElementsByClassName("number")[2].innerHTML=this.number3();


            if (number1 === number2 && number1 === number3)
            {
                document.getElementById('result').innerHTML="Wygrałeś";
            }
            else
            {
                document.getElementById('result').innerHTML="Przegrałeś";
            }

        },

        send_result: function (number1, number2, number3, result) {

            $.ajax({
                type: "POST",
                url: "/game/result",
                dataType: "json",
                data: {
                    number1: number1,
                    number2: number2,
                    number3: number3,
                    result: result
                },
                success: function(response) {
                    console.log(response);
                }
            });

        }



    };

    $('#btn').click(function() {
        game.raffle();
    });



});