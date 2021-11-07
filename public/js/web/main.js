$(function() {

    var list = $('.groupPortfolio');
    
    list.click(function() {

        var dataGroup = $(this).attr('data-group');
        var portfolio = $('.portfolio-area');
        list.removeClass('active');

        if(dataGroup == 'all') {
            $(this).addClass('active');
            portfolio.show('1000');

        } else {    

            $(this).addClass('active');
            portfolio.not('.' + dataGroup).hide('1000');
            portfolio.filter('.' + dataGroup).show('1000');
        }

    });
});