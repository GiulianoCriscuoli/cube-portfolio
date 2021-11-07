$(function() {

    var list = $('.groupPortfolio');
    
    list.click(function() {

        var dataGroup = $(this).attr('data-group');
        var portfolio = $('.portfolio-area');

        if(dataGroup == 'all') {

            portfolio.show('1000');

        } else {

            portfolio.not('.' + dataGroup).hide('1000');
            portfolio.filter('.' + dataGroup).show('1000');
        }

    });
});