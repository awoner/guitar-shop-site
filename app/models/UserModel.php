<?php
include_once 'core/sql.php';
//include_once '/app/models/CRUD.php';

class UserModel /*implements CRUD*/ {
    private $id = null;
    private $name = null;
    private $email = null;
    private $password = null;

    public function __construct(){}

    public function __get($field){
        return $this->$field;
    }

//    public function findId($id){
//        $fields = SqlBuilder::table('users')->select()
//            ->where(array(":id" => $id), '=')->get();
//        $fields = $fields[0];
//        foreach ($fields as $key => $value) {
//            $this->$key = $value;
//        }
//        return $fields;
//    }

    public static function userCheck($where1, $where2 = [], $where3 = []){
        if(!empty($where3)) {
            return SqlBuilder::table('users')->select()
                ->where($where1, '=')
                ->where($where2, '=')
                ->where($where3, '=')->get();//get
        }else{
            return SqlBuilder::table('users')->select()
                ->where($where1, '=')
                ->where($where2, '=')->get();
        }
    }

    public static function check($where){
        return SqlBuilder::table('users')->select()
            ->where($where, '=')->get();//get
    }

    public static function update($fields, $where1, $where2 = []){
        if(!empty($where2)) {
            SqlBuilder::table('users')->update($fields)
                ->where($where1, '=')->where($where2, '=')->send();//send
        }else {
            SqlBuilder::table('users')->update($fields)
                ->where($where1, '=')->send();//send
        }
    }

    public static function insert($fields){
        SqlBuilder::table('users')->insert($fields)->send();//send
    }

//    public function read(){
//        $fields = SqlBuilder::table('users')->select()
//            ->where(array(":id" => $this->id), '=')->get();
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
//    //$name, $surname, $patronymic, $birth_date, $fp_name
//    public static function create($fields){
//        SqlBuilder::table('users')->insert($fields)->send();
//        return new static();
//    }
//
//    public function update($field){
//        $key = str_replace(":", "", key($field));
//        $this->$key = $field[key($field)];
//        SqlBuilder::table('users')->update($field)
//            ->where(array(':id' => $this->id),'=')->send();
//    }
//
//    public function delete(){
//        SqlBuilder::table('users')->delete()->where(array(':id' => $this->id),'=')
//            ->send();
//        $this->id = null;
//        $this->name = null;
//        $this->email = null;
//        $this->password = null;
//    }

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