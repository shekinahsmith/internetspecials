// generate total points
function getGrade(p) {

    // points
    const grades = {
        i75Choice: 123,
        i50Choice: 120,
        i75Entertainment: 113,
        i50Entertainment: 110,
        i75Select: 103,
        i50Select: 100,
        i75: 3,
        i50: 2
    };

    var grade = 'i50';
    Object.keys(grades).some(function (k) {
        if (p >= grades[k]) {
            grade = k;
            return true;
        }
    });
    return grade
}

module.exports = getGrade;