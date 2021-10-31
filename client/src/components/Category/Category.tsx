import { useEffect, useState } from 'react'

function Category() {
    const [post, setPost] = useState([]);
    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch(`http://localhost/php_blog/api/post/category.php`);
            const newData = await response.json();
            setPost(newData);
          };
          fetchData();
          console.log(post);
    });
    return (
        <div>
            
        </div>
    )
}

export default Category
