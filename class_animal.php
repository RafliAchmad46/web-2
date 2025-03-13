<?php
class Animal {
    public $animals;
    public function __construct($ar_animal) 
    {
        $this->animals = $ar_animal;
    }
    public function index(){
        foreach ($this->animals as $animal) {
            echo "- $animal <br/>";
        }
    }

    public function store($animal){
        $this->animals[] = $animal;
    }

    public function update($index, $animal){
        $this->animals[$index] = $animal;
    }

    public function destroy($index){
        unset($this->animals[$index]);
    }
}

#membuat object
#kirimkan data array ke dalam constructor

$animals = new Animal(['Ayam', 'Ikan']);

echo "Index - Menampilkan seluruh hewan <br/>";

$animals->index();
echo "<br/>";

#Method Store
echo "Store - Menambahkan hewan baru (Burung)<br/>";
$animals->store('Burung');
$animals->index();
echo "<br/>";

#Method Update
echo "Update - Mengupdate hewan <br/>";
$animals->update('0', 'Kucing Anggora');
$animals->index();
echo "<br/>";

#Method Destroy
echo "Destroy - Menghapus hewan <br/>";
$animals->destroy('1');
$animals->index();
echo "<br/>";
?>