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
    let json = "[9,8,7,6,5,4,3,2,1]";
    let mut list: Vec<i32> = serde_json::from_str(&json).unwrap();
    list = bubble_sort(list);
    println!("{:?}", list);
}
