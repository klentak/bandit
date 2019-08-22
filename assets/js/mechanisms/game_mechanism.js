var $ = require('jquery');


$(document).ready(function () {
var slot_machine = {




    generate: function(){
        this.number1= Math.floor(Math.random() * 10);
        this.number2= Math.floor(Math.random() * 10);
        this.number3= Math.floor(Math.random() * 10);

        this.win = (this.number1 === this.number2 && this.number1 === this.number3);
    },

    random_numbers: function() {
        $('#slot1').html(Math.floor(Math.random() * 10));
        $('#slot2').html(Math.floor(Math.random() * 10));
        $('#slot3').html(Math.floor(Math.random() * 10));
    },

    win_numbers: function() {
        $('#slot1').html(this.number1);
        $('#slot2').html(this.number2);
        $('#slot3').html(this.number3);
    },


    raffle: function() {

        var history = {};

        var bid = $('#bid').val();

        setInterval(function () {
            $('#slot1').html(number());
        }, 50);




        history = {
            numbers: [numbers[0], numbers[1], numbers[2]],
            result: win,
            bid: bid
        };
        console.log(history);

        $.ajax({
            method: "post",
            url: 'game/save_result',
            dataType: "json",
            data: history
        })
            .done(response => {
                console.log(response);
            });

        score();
    },

    score: function() {
        var score;

        $.ajax({
            method: "post",
            url: 'game/get_score',
            dataType: "json",
            success: function (score) {
                $('#score').html('$ ' + score['score']);
            },
        });
    }



};

$('#btn').click(function () {
    slot_machine.generate();
    var raffle = setInterval(slot_machine.random_numbers, 50);
        $.ajax({
            method: "post",
            url: 'game/get_score',
            dataType: "json",
            success: function (score) {
                if (score['score'] > $('#bid').val()) {


                    setTimeout(clearInterval(raffle), 1000);
                    setTimeout(slot_machine.win_numbers(),1000);
                } else {
                    alert("Nie masz wystarczającej ilości punktów!");
                }
            },
        });
    });
});