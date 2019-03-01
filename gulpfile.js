const gulp = require("gulp"),
    sass = require("gulp-sass"),
    autoprefixer = require("gulp-autoprefixer");

gulp.task("sass", () =>
    gulp.src("./public/scss/styles.scss")
        .pipe(sass({
            outputStyle: "expanded",
            sourceComments: true
        }))
        .pipe(autoprefixer({
            versions: ["last 2 browsers"]
        }))
        .pipe(gulp.dest("./public/css"))
);

gulp.task("default", () => {
    gulp.watch("./public/scss/styles.scss", ["sass"]);
});