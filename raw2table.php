<?php
/**
 * Class raw2table
 * Created by: S1 Teknik Informatika '16 Universitas Negeri Malang
 *
 * Team members:
 * 1. Achmad Yuliyanto Firdausi (achmadyuliyanto81@gmail.com)
 * 2. Aditya Rahman (adityarahman032@gmail.com)
 * 3. Agung
 * 4. Anita Sjahrunnisa (arisanita98@gmail.com)
 * 5. Annisa Putri Ayudhitama (ichadhitama@gmail.com)
 * 6. Bekti Pitriani (bektipitriani11@gmail.com)
 * 7. Bima Garis Invarian (bimagaris28@gmail.com)
 * 8. Bintang Hauriza (bintang.hauriza1@gmail.com)
 * 9. Cevin Ways Al Cornelis (cevinways34@gmail.com)
 * 10. Daniel Imam Supomo (danielimam7@gmail.com)
 *
 * example:
 * <?php
 *      $obj = new raw2table();
 *      $data = $obj->convert_data($_POST['name']);
 *      print_r($obj->get_freq_dist_table($data));
 * ?>
 *
 * note:
 * to get table you can use HTML
 */

    class raw2table {
        // convert data from input or textarea to array
        public function convert_data($data) {
            return preg_split('/[\s]+/', $data);
        }

        // get maximum value from data
        public function get_max($data) {
            return max($data);
        }

        // get minimum value from data
        public function get_min($data) {
            return min($data);
        }

        // get range from data
        public function get_range($data) {
            return $this->get_max($data) - $this->get_min($data);
        }

        // count how many classes on table
        public function get_many_classes($data) {
            return round(1 + (3.33 * log10(count($data))));
        }

        // count long data per-class
        public function get_long_class($data) {
            return ceil($this->get_range($data) / $this->get_many_classes($data));
        }

        // get total data
        public function get_total_data($data) {
            return count($data);
        }

        // get array sum
        public function get_array_sum($data) {
            return array_sum($data);
        }

        // data in array with key max, min, freq
        public function get_freq_dist_table($data) {
            // to get long per-class and count many classes
            $long_class = $this->get_long_class($data);
            $many_classes = $this->get_many_classes($data);

            // to set minimum value and maximum value per-class
            $min_class_value = $this->get_min($data);
            $max_class_value = $min_class_value + ($long_class - 1);

            // create array for return function
            $return_data = array();

            // count how many data per-class (frequensi)
            for($x = 0; $x < $many_classes; $x++) {
                foreach ($data as $item) {
                    if($item >= $min_class_value && $item <= $max_class_value) {
                        $return_data[$x] = array(
                            "min" => $min_class_value,
                            "max" => $max_class_value,
                            "freq" => $return_data[$x]['freq'] += 1
                        );
                    }
                }
                $min_class_value += $long_class;
                $max_class_value += $long_class;
            }
            return $return_data;
        }
    }