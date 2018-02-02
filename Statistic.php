<?php

/*
*
* Member :
* 1. Deo Pradipta Putra Setyadi (deopradipta2010@gmail.com)
* 2. Dhimas Febri Subhirianto
* 3. Dimas Mohammad Jawaharal Nahru
* 4. Dimas Yoga Trivivanto
* 5. Dinda Amanda Mutia
* 6. Dwi Nur Muhammad Revian
* 7. Dwiajeng Puspita Ratri (dwiajengpuss1997@gmail.com)
* 8. Eko Triono
* 9. Eris Dwi Septiawan Rizal (erisdsr@gmail.com)
* 10.Faqih Auliyaur Rohman (faqihleite@gmail.com)
*
*/
include "raw2table.php";

class Statistic extends raw2table {
	public function q1($data){
		return 1*($this->get_total_data($data)+1)/4;
	}

	public function q2($data){ 
		return 2*($this->get_total_data($data)+1)/4;
	}

	public function q3($data){
		return 3*($this->get_total_data($data)+1)/4;
	}

	public function varian($data){
		sort($data);
	    $hasilRata = $this->mean($data);
	    $jumlahTotalPangkat = 0;
	    for ($i = 0; $i < sizeof($data); $i++) {
	        $temp1 = $data[$i] - $hasilRata;
	        $temp1 = $temp1 * $temp1;
	        $jumlahTotalPangkat += $temp1;
	    }
	    return $jumlahTotalPangkat / sizeof($data);
	}

	public function mean($data){
		$mean = 0;
		$mean = $this->get_array_sum($data)/$this->get_total_data($data);
		return $mean;
	}

	public function median($data){
		$total = $this->get_total_data($data);
		if($total % 2 == 0){
			$d1 = $total / 2;
			$d2 = $d1 + 1;
			$nilai_median=$data[$d1]+($data[$d2]-$data[$d1])/2;
			return $nilai_median;
		}
		else {
			$dt=($total+1)/2;
			$nilai_median=$this->data[$dt];
			return $nilai_median;
		}
	}

	public function modus($data){
		$a=array_count_values($data);
		$ke = 0;
		$modos = array();
		foreach ($a as $key => $val) {
		    if($val==max($a)){
		    	$modos[$ke] = $key;
		    	$ke++;
		    }
		}
		return $modos;
	}

	public function std_deviasi($data){
		return sqrt($this->varian($data));
	}
}

/*
*
* CONTOH PENGGUNAAN CLASS
*
*/


$data = array(4,3,2,3,2,4,6,7,33,10);
$statistic = new Statistic();

echo "Data : ";

for($i=0;$i<count($data);$i++){
	echo $data[$i]." ";
}
/*
echo "<br/>";
echo "Q1 : ".$statistic->q1($data)."<br />";
echo "Q2 : ".$statistic->q2($data)."<br />";
echo "Q3 : ".$statistic->q3($data)."<br />";
echo "Mean : ".$statistic->mean($data)."<br />";
echo "Varian : ".$statistic->varian($data)."<br />";
echo "Std Deviasi : ".$statistic->std_deviasi($data)."<br />";

echo "Modus : ";
foreach ($statistic->modus($data) as $val) {
	echo $val." ";
}
echo "<br/>";

echo "Median : ".$statistic->median($data)."<br />";
*/
?>