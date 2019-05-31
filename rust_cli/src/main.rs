use std::fs::File;
use std::io::Read;
use std::time::Instant;
extern crate serde;
extern crate serde_json;

fn bubble_sort(mut list: Vec<i32>) -> Vec<i32> {
    let len = list.len() - 1;
    let mut sorted = false;

    while !sorted {
        sorted = true;
        for i in 0..len {
            let current = list[i];
            let next = list[i + 1];

            if next < current {
                list[i] = next;
                list[i + 1] = current;
                sorted = false;
            }
        }
    }

    list
}

fn main() {
    let mut file = File::open("list.json").unwrap();
    let mut json = String::new();
    file.read_to_string(&mut json).unwrap();
    let mut list: Vec<i32> = serde_json::from_str(&json).unwrap();
    let now = Instant::now();
    list = bubble_sort(list);
    let time = now.elapsed().subsec_nanos();
    println!("{}", time);
}
