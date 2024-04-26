export default function ifExistFile(file) {
    try {
        if(file){
            var req = new XMLHttpRequest();
            req.open('GET', file, false);
            req.send();
            if(req.status==200){
                return file;
            }else{
                return '/images/no-image.png';
            };
        } else {
            return '/images/no-image.png';
        }
    } catch (e) {
        return '/images/no-image.png';
    }
}

