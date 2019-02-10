<?php


class BrandModel{
    private $id = null;
    private $name = null;

    public function __construct(){}

    public function __get($field){
        return $this->$field;
    }

    public function findId($id){
        require 'configuration.php';
        $fields = $db::table('brand')->select()->where(array(':id' => $id), '=')->get();
        $fields = $fields[0];
        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
        return $fields['name'];
    }

    public function findName($name){
        require 'configuration.php';
        $fields = $db::table('brand')->select()->where(array(':name' => $name), '=')->get();
        $fields = $fields[0];
        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
        return $fields['id'];
    }

    public function getAll(){
        require 'configuration.php';
        return  $db::table('brand')->select()->get();
    }

//    public function read(){
//        $fields = SqlBuilder::table('students')->select()
//            ->where(array(":student_id" => $this->student_id), '=')->get();
//        $fields = $fields[0];
//        echo '<table border="1">'
//            . "<caption>Student</caption>"
//            . "<tr>";
//        while(current($fields) != null){
//            echo "<th>" . key($fields) . "</th>";
//            next($fields);
//        }
//        echo "</tr><tr>";
//
//        foreach ($fields as $v){
//            echo "<td>" . $v . "</td>";
//        }
//        echo "</tr>";
//    }
    //$name, $surname, $patronymic, $birth_date, $fp_name
    public static function create($fields){
        require 'configuration.php';
        $db::table('brand')->insert($fields)->send();
        return new static();
    }

    public function update($field){
        require 'configuration.php';
        $key = str_replace(":", "", key($field));
        $this->$key = $field[key($field)];
        $db::table('brand')->update($field)
            ->where(array(':id' => $this->id),'=')->send();
    }

    public function delete(){
        SqlBuilder::table('brand')->delete()->where(array(':id' => $this->id),'=')
            ->send();
        $this->id = null;
        $this->name = null;
    }
//    public function register_fp($fp_id){
//        $fp = SqlBuilder::table('fp')->select()->where(array(':fp_id' => $fp_id), '=')->get();
//        $fp = $fp[0];
//        SqlBuilder::table('students')->update(array(':fp_name' => $fp['fp_name']))
//            ->where(array(':student_id' => $this->student_id),'=')->send();
//        $this->fp_name = $fp['fp_name'];
//    }
//
//    public function passed_exam($exam_id){
//        $exam = SqlBuilder::table('exams')->select()->where(array(':exam_id' => $exam_id), '=')->get();
//        $exam = $exam[0];
//        SqlBuilder::table('students')->update(array(':exam_name' => $exam['exam_name']))
//            ->where(array(':student_id' => $this->student_id),'=')->send();
//        $this->exam_name = $exam['exam_name'];
//    }
}