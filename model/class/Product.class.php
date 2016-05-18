<?php

class Product {
  /**
   * Représente un produit vs model dolibarr :
   * Un produit peut avoir plusieurs producteurs
   * Un produit peut avoir plusieures catégories
   *
   */
		private 	$id,
						$title,
						$ref, // reference produit
						$price,
						$price_u, // int val of price
						$price_d, // int format of price's decimal
						$tva,
						$packaging, 
						$weight,
						$weight_unit,
						$description = "",
						$is_active,
						$img,
						
						//objets : 
						
						$categories,
						$producers;
		
		public function __construct(array $data)	{
			$this->hydrate($data);
		}
    /**
     * loads data from a db record
     */
		public function hydrate(array $data){
			foreach ($data as $key => $value){
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)){
						$this->$method($value);
				}
			}
		}	
		//getter
		public function id() {return $this->id;}
		public function title() {return $this->title;}
		public function price() {return $this->price;}
		public function price_u() {return $this->price_u;}
		public function price_d() {return $this->price_d;}
		public function tva() {return $this->tva;}
		public function packaging() {return $this->packaging;}
		public function weight() {return $this->weight;}
		public function weight_unit() {return $this->weight_unit;}
		public function description() {return $this->description;}
		public function is_active() { return $this->is_active;}
		public function img() {return $this->img;}
		public function ref() {return $this->ref;}
		
		public function categories() { return $this->categories;}
		public function producers() { return $this->producers;}
		//setter
		public function setId($id) { $this->id = (int) $id;}
		public function setTitle($title) { $this->title = strtoupper($title);}
		public function setPrice($price) { 
			$this->price =  round($price, 2, PHP_ROUND_HALF_UP);
			$this->price_u = floor($this->price);
			$this->price_d = ($this->price-floor($this->price))*100;
		}
		public function setCategories($categories) { $this->categories =  $categories;}
		public function setTva($tva) { $this->tva =  $tva;}
		public function setPackaging($packaging) { $this->packaging = $packaging;}
		public function setWeight($weight) {$this->weight = $weight;}
		public function setWeight_unit($unit) {
			switch($unit){
				case "0" : 
					$wu = "Kg";
				break;
				case "-3" :
					$wu = "g";
			}
			$this->weight_unit = $wu;
		}
		public function setDescription($description) { 
			if (is_string($description))
				{$this->description = $description;}
		}
		public function setIs_active($is_active) { $this->is_active = $is_active;}
		public function setImg($img) { $this->img = $img;}
		public function setRef($ref) { $this->ref = $ref;}
				
}
