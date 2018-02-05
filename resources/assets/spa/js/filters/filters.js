Vue.filter('numberFormat', {
    read(value,locale = "pt-BR"){
        let number = 0;
        if(value && typeof value !== undefined){
            let numberRegex = value.toString().match(/\d+(\.{1}\d{1,2}){0,1}/g);
            number = numberRegex ? numberRegex[0] : 0;
        }
        return new Intl.NumberFormat(locale,{
            maximumFractionDigits: 2,
            minimumFractionDigits: 2,
            style: 'currency',
            currency: 'BRL'
        }).format(number);
    },
    write(value){
        let number = 0;
        if(value.length > 0){
            number = value.replace(/[^\d\,]/g, '')
                .replace(/\,/g,'.');
            number = isNaN(number) ? 0 : parseFloat(number);
        }
        return number;
    }
});