import React, { useEffect } from "react";
import api from "../../api/axios";
import { usePosts } from "../../context/PostsContext";
import DisplayHistoryOrSavedPosts from "../../components/displayPosts/DisplayHistoryOrSavedPosts";
function Saved() {
  const { loadSavedPosts, setLoadSavedPosts, addPostsToSection } = usePosts();

  useEffect(() => {
    async function getPosts() {
      let res = await api.get("user/posts/saved");
      if (!res.error) {
        const posts = res.data.posts;
        addPostsToSection(posts, "saved");
      }
      setLoadSavedPosts(false);
    }
    getPosts();
  }, []);
  // console.log(posts);
  return (
    <div className='container-c'>
      <DisplayHistoryOrSavedPosts
        toryOrSavedPosts
        loading={loadSavedPosts}
        pageTitle={"Saved"}
        type={"view"}
      />
    </div>
  );
}

export default Saved;
