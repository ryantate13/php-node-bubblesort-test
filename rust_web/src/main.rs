use warp::{self, Filter};
use std::time::Instant;

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

#[cfg(debug_assertions)]
fn port() -> u16 {
    8000
}

#[cfg(not(debug_assertions))]
fn port() -> u16 {
    80
}

fn main() {
    let bubble_sort_server = warp::post2()
        .and(warp::body::json())
        .map(|mut _list| -> String {
            let now = Instant::now();
            _list = bubble_sort(_list);
            let time = now.elapsed().subsec_nanos();
            format!("{}", time)
        });

    println!("rust_web up on port {}", port());

    warp::serve(bubble_sort_server)
        .run(([0, 0, 0, 0], port()));
}